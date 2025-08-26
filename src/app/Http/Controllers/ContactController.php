<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 入力ページ
    public function index(Request $request)
    {
        $categories =
            Category::orderBy('id')->pluck('content', 'id');
        $data = session('contact_input', [
            'family_name' =>
            old('family_name'),
            'given_name' =>
            old('given_name'),
            'gender' => old('gender', '1'), //デフォルト：男性=1
            'email' => old('email'),
            'tel' => old('tel'),
            'address' => old('address'),
            'building' => old('building'),
            'category_id' => old('category_id'),
            'detail' => old('detail'),
        ]);
        return view(
            'contact.create',
            compact('categories', 'data')
        );
    }

    // 確認ページ
    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $request->session()->put('contact_input', $validated);
        $category =
            Category::find($validated['category_id']);
        $categoryName = $category->name ?? '';

        $genderName = [
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他',
        ][$validated['gender']] ?? '';
        return view('contact.confirm', [
            'data' => $validated,
            'categoryName' => $categoryName,
            'genderName' => $genderName,
        ]);
    }

    // サンクスページ
    public function store(Request $request)
    {
        $data = session('contact_input');
        abort_unless($data, 403);

        $payload = [
            'last_name' =>
            $data['family_name'],
            'first_name' =>
            $data['given_name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'address' => $data['address'],
            'building' => $data['building'] ?? null,
            'category_id' => $data['category_id'],
            'detail' => $data['detail'],

        ];

        Contact::create($payload);

        $request->session()->forget('contact_input');

        return
            redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
