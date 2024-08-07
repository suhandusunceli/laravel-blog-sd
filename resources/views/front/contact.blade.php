@extends('front.layouts.master')

@section('title', 'İletişim')
@section('bg', 'https://images.squarespace-cdn.com/content/v1/54681b9de4b01b5f0d0ebafb/1416126155014-PV178ZNJV28C418YG89T/contact-bg.jpg?format=1500w')

@section('content')
    <div class="col-md-7 mx-auto">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p>Bizimle iletişime geçebilirsiniz.</p>

        <div class="my-5">
            <form method="post" action="{{ route('contact.post') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Ad Soyadınız" />
                    <label for="name">Ad Soyad</label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ old('email') }}" placeholder="Email Adresiniz" />
                    <label for="email">Email Adresi</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="topic" class="form-label">Konu</label>
                    <select id="topic" class="form-control" name="topic">
                        <option value="">Seçiniz</option>
                        <option value="Bilgi" {{ old('topic') == 'Bilgi' ? 'selected' : '' }}>Bilgi</option>
                        <option value="Destek" {{ old('topic') == 'Destek' ? 'selected' : '' }}>Destek</option>
                        <option value="Genel" {{ old('topic') == 'Genel' ? 'selected' : '' }}>Genel</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Mesajınızı buraya yazınız..." style="height: 12rem">{{ old('message') }}</textarea>
                    <label for="message">Mesajınız</label>
                    @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit success message -->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center mb-3">
                        <div class="fw-bolder">Form başarıyla gönderildi!</div>
                        Formu etkinleştirmek için, şu adrese kaydolun:
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>

                <!-- Submit error message -->
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Mesaj gönderilirken hata oluştu!</div>
                </div>

                <!-- Submit Button -->
                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
            </form>
        </div>
    </div>
@endsection
