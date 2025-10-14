@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
  <div class="admin-form__heading">
    <h2>Admin</h2>
  </div>
  @if (Auth::check())
  <form action="/logout" method="post">
      @csrf
      <button class="header-nav__button">ログアウト</button>
    </form>
    @endif
  <form class="search-form" action="/admin" method="post">
    @csrf
     <div class="search-form__item">
    <input class="search-form__item-input" type="text" placeholder="名前やメールアドレスを入力してください" name="keyword" value="{{ old('keyword') }}">
     <select class="search-form__item-select" name="gender">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
     </select>   
     <select class="search-form__item-select" name="category_id">
        <option value="">お問い合わせの種類</option>
         @foreach ($categories as $category)
         <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
         @endforeach
      </select>    
     <input type="date" name="created_at" value="{{ request('created_at') }}">
     <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
    <div class="reset-form__button">
      <button class="reset-form__button-submit" type="reset">リセット</button>
    </div>
</form>
<table>
  <tr>
    <th>お名前</th>
    <th>性別</th>
    <th>メールアドレス</th>
    <th>お問い合わせの種類</th>
  </tr>
  @foreach ($contacts as $contact)
  <tr>
    <td>{{$contact->first_name}}{{$contact->last_name}}</td>
    <td>
      @if($contact->gender == 1)
        男性
      @elseif($contact->gender == 2)
        女性
      @else
        その他
      @endif
    </td>
    <td>{{$contact->email}}</td>
    <td>{{$contact['category']['content']}}</td>
     <td>
      <button type="button" class="btn btn-primary mb-12" data-toggle="modal" data-target="#modal{{$contact->id}}">詳細</button>
      </td>
  </tr>
  @endforeach
  </table>

  <div>{{ $contacts->links() }}</div>
  @foreach ($contacts as $contact)
  <div class="modal fade" id="modal{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           
            <div class="modal-body">
                <table>
                  <tr>
                    <th>お名前</th>
                    <td>{{$contact->first_name}}{{$contact->last_name}}</td>
                  </tr>
                  <tr>
                  <th>性別</th>
                  <td>
                    @if($contact->gender == 1)
                     男性
                    @elseif($contact->gender == 2)
                     女性
                    @else
                     その他
                    @endif
                  </td>
                  </tr>
                  <tr>
                  <th>メールアドレス</th>
                  <td>{{$contact->email}}</td>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td>{{$contact->tel}}</td>
                  </tr>
                  <tr>
                    <th>住所</th>
                    <td>{{$contact->address}}</td>
                  </tr>
                  <tr>
                    <th>建物名</th>
                    <td>{{$contact->building}}</td>
                  </tr>
                  <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{$contact->category->content}}</td>
                  </tr>
                  <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{$contact->detail}}</td>
                  </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">×</button>
                <form action="/admin" method="post">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="id" value="{{ $contact->id }}">
                   <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
 @endforeach
  