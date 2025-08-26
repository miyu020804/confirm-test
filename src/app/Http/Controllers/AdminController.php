<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query =
            $this->buildQuery($request);


        $contacts = $query->orderByDesc('id')
            ->paginate(7)

            ->appends($request->query());

        $genders = ['all' => '全て', 'male' => '男性', 'female' => '女性', 'other' => 'その他'];
        $categories =
            Category::orderBy('id')->pluck('content', 'id');
        return view(
            'admin.index',
            compact('contacts', 'genders', 'categories')
        );
    }


    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }


    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        if (request()->wantsJson()) return
            response()->noContent();
        return redirect()->route('admin.index')->with('status', '削除しました。');
    }

    public function export(Request $request)
    {
        $rows =
            $this->buildQuery($request)->orderByDesc('id')->with('category')->get();

        $headers = [
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($rows) {
            $out = fopen(
                'php://output',
                'w'
            );

            fprintf(
                $out,
                chr(0xEF) . chr(0xBB) . chr(0xBF)
            );
            fputcsv($out, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種別', '内容', '登録日']);

            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->id,
                    $r->first_name,
                    $r->last_name,
                    [1 => '男性', 2 => '女性', 3 => 'その他'][$r->gender] ?? '',
                    $r->email,
                    $r->tel,
                    $r->address,
                    $r->building,

                    optional($r->created_at)->format('Y-m-d'),
                ]);
            }
            fclose($out);
        };
        return
            response()->stream(
                $callback,
                200,
                $headers
            );
    }


    private function buildQuery(Request $request)
    {
        $q = Contact::query();

        if ($request->filled('name')) {
            $name = trim($request->name);
            if (preg_match(
                '/\s+/',
                $name,
            )) {

                [$last, $first] =
                    array_map('trim', preg_split('/\s+/', $name, 2));
                if ($last)
                    $q->where('last_name', 'like', "%{$last}%");
                if ($first)
                    $q->where('first_name', 'like', "%{$first}%");
            } else {
                $q->where(function ($sub) use ($name) {

                    $sub->where('first_name', 'like', "%{$name}%")

                        ->orWhere('last_name', 'like', "%{$name}%")

                        ->orWhereRaw("CONCAT(last_name, first_name)
                    LIKE ?", ["%{$name}"]);
                });
            }
        }

        if ($request->filled('email')) {
            $match = $request->input(
                'match',
                'partial'
            );
            if ($match === 'exact') {
                $q->where('email,
                $request->email');
            } else {
                $q->where('email', 'like', "%{$request->email}");
            }
        }
        if (
            $request->filled('gender') &&
            $request->gender !== 'all'
        ) {
            $q->where('gender', (int)
            $request->gender);
        }

        if ($request->filled('category_id')) {

            $q->where('category_id', (int)
            $request->category_id);
        }

        if ($request->filled('date')) {
            $q->whereDate(
                'created_at',
                $request->date
            );
        }
        return $q;
    }
}
