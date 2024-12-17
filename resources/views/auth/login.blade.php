<style>
    body {
        margin: 0;
        padding: 0;
        background: url('/kaiadmin/pdam.jpg');
        background-size: cover;
        background-position: center;
        font-family: sans-serif
    }

    .loginbox {
        width: 420px;
        height: 530px;
        background: rgba(0, 0, 0, 0.7);
        color: #ffffff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        border-radius: 10px 20px 30px 40px;
        padding: 70px 30px
    }
    
    h1 {
        margin: 30px;
        padding: 0 0 20px;
        text-align: center;
        font-size: 22px
    }

    .loginbox p {
        margin: 0;
        padding: 0;
        font-weight: bold
    }
    .centered-content {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    }

    .loginbox input {
        width: 100%;
        margin-bottom: 20px
    }

    .loginbox input[type="text"],
    input[type="password"] {
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 40px;
        color: #fff;
        font-size: 16px
    }

    .loginbox input[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        background: #69fb25;
        color: #fff;
        font-size: 18px;
        border-radius: 20px
    }

    .loginbox input[type="submit"]:hover {
        cursor: pointer;
        background: #ffc107;
        color: #000
    }

    .loginbox a {
        text-decoration: none;
        font-size: 12px;
        line-height: 20px;
        color: darkgrey
    }

    .loginbox a:hover {
        color: #ffc107
    }
</style>


<div class="loginbox">
    <div class="centered-content">
        <img src="{{ asset('kaiadmin/logo.png') }}" width="150px" alt="Contoh Gambar">
        <h3>PERUMDAM TIRTA BENING</h3>
    </div>
    <h1 class="mx-6">L O G I N</h1>
    <form action="{{ route('pegawai.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <p>USERNAME</p>
            <input type="text" name="username" type="text" class="form-control" placeholder="Username"
                value="{{ old('username') }}">
            @error('username')
            <div class="invalid-feedback" style="display: block;">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <p>PASSWORD</p>
            <input name="password" type="password" class="form-control" placeholder="Password">
            @error('password')
            <div class="invalid-feedback" style="display: block;">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" name="" value="SUBMIT">
            <br>
            {{-- <a href="{{ route('register') }}" class="text-center" >Don't have an account?</a> --}}
        </div>
    </form>
</div>