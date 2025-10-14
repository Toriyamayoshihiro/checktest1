@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form class="form" action="/confirm" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="first_name" placeholder="山田" value="{{ old('first_name') }}" />
        </div>
        <div class="form__error">
          @error('first_name')
          {{ $message }}
          @enderror
        </div>
        <div class="form__input--text">
        <input type="text" name="last_name" placeholder="太郎" value="{{ old('last_name') }}" />
        </div>
         <div class="form__error">
          @error('last_name')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
　　<div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">性別</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
            <label>
             <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }} />男性
            </label>
            <label>
             <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性
            </label>
            <label>
             <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他
            </label>
        </div>
        <div class="form__error">
          @error('gender')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
            <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="4" />     
             <span class="form__hyphen">-</span>
         　　<input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="4" />     
             <span class="form__hyphen">-</span>
             <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="4" />     
        </div>
        <div class="form__error">
          @error('tel1'){{ $message }}@enderror
          @error('tel2'){{ $message }}@enderror
          @error('tel3'){{ $message }}@enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
       <div class="form__input--text">
        <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
        </div>
         <div class="form__error">
          @error('address'){{ $message }}@enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物名</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
       <div class="form__input--text">
        <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
       </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">※</span>
      </div>
      <select name="category_id" class="select">
        <option value="">選択してください</option> 
      @foreach($categories as $category)
        <option value="{{ $category->id }}"      {{ old('category_id') == $category->id ? 'selected' : '' }}>  
        {{ $category->content }}    
        </option>  
      @endforeach
      </select>
    </div> 
    @error('category_id'){{ $message }}@enderror
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        </div>
      </div>
    </div>
    @error('detail'){{ $message }}@enderror
    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection