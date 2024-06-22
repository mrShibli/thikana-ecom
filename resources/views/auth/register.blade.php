@extends('layouts.authmaster')

@section('styles')
    <style>
        .input-group-text {
            cursor: pointer;
        }

        .progress {
            height: 10px;
        }

        .progress-bar {
            transition: width 0.5s;
        }

        .strength-text {
            margin-top: 5px;
            font-weight: bold;
            transition: color 0.5s;
        }

        .requirements {
            list-style-type: none;
            padding: 0;
            margin: 10px 0 0 0;
        }

        .requirements li {
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .requirements li.valid::before {
            content: '✔';
            color: green;
            margin-right: 5px;
        }

        .requirements li.invalid::before {
            content: '✖';
            color: red;
            margin-right: 5px;
        }

        .email-existing {
            font-size: 0.9rem;
            color: red;
            margin-top: 5px;
            font-weight: 400 !important;
        }
    </style>
@endsection

@section('content')
    <div class="my-">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <div class="container form-container">
        <div class="registration-form">
            <div class="form-logo text-center">
                <img src="{{ asset('clientside/images/logo.png') }}" alt="" class="img-fluid" width="150">
            </div>
            <h5 class=" mt-1 text-center">{{ __('Register Now!') }}</h5>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="fullname">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name"
                        autocomplete="name" name="name" autofocus required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" id="email" placeholder="Enter your email" autocomplete="email"
                        required>
                    <div class="email-existing"></div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <div class="input-group mt-2">
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <button id="toggle-password" class="btn btn-outline-primary" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div id="password-strength" class="progress-bar" role="progressbar" style="width: 0;"></div>
                    </div>
                    <div id="strength-text" class="strength-text"></div>
                    <ul id="password-requirements" class="requirements">
                        <li id="length" class="invalid">Minimum 8 characters</li>
                        <li id="lowercase" class="invalid">At least one lowercase letter</li>
                        <li id="uppercase" class="invalid">At least one uppercase letter</li>
                        <li id="number" class="invalid">At least one number</li>
                        <li id="special" class="invalid">At least one special character</li>
                    </ul>

                    <span id="password-error" class="invalid-feedback" role="alert" style="display: none;">
                        <strong>Password error message</strong>
                    </span>
                    <a id="generate-password" class="btn btn-primary mt-1">Generate Password</a>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                </div>
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block email-existing">
                            <small>{{ $errors->first('g-recaptcha-response') }}</small>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>

                @if (Route::has('register'))
                    <a class="mt-2" href="{{ route('login') }}"><small> <span>Existing User ?</span>
                            {{ __('Login') }}</small>
                    </a>
                @endif

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function generatePassword(length = 12) {
            if (length < 4) {
                throw new Error("Password length should be at least 4 characters");
            }

            const lowercase = "abcdefghijklmnopqrstuvwxyz";
            const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const digits = "0123456789";
            const specialCharacters = "!@#$%^&*()-_=+[]{}|;:,.<>?";

            let password = [
                lowercase[Math.floor(Math.random() * lowercase.length)],
                uppercase[Math.floor(Math.random() * uppercase.length)],
                digits[Math.floor(Math.random() * digits.length)],
                specialCharacters[Math.floor(Math.random() * specialCharacters.length)]
            ];

            const allCharacters = lowercase + uppercase + digits + specialCharacters;
            for (let i = password.length; i < length; i++) {
                password.push(allCharacters[Math.floor(Math.random() * allCharacters.length)]);
            }

            password = password.sort(() => Math.random() - 0.5);
            return password.join('');
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]+/)) strength += 1;
            if (password.match(/[A-Z]+/)) strength += 1;
            if (password.match(/[0-9]+/)) strength += 1;
            if (password.match(/[\W_]+/)) strength += 1;
            return strength;
        }

        function updatePasswordStrength(password) {
            const strength = checkPasswordStrength(password);
            const progressBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('strength-text');
            const strengths = [{
                    width: '0%',
                    color: 'bg-danger',
                    text: 'Very Weak',
                    textColor: 'red'
                },
                {
                    width: '20%',
                    color: 'bg-danger',
                    text: 'Weak',
                    textColor: 'red'
                },
                {
                    width: '40%',
                    color: 'bg-warning',
                    text: 'Moderate',
                    textColor: 'orange'
                },
                {
                    width: '60%',
                    color: 'bg-info',
                    text: 'Good',
                    textColor: 'blue'
                },
                {
                    width: '80%',
                    color: 'bg-primary',
                    text: 'Strong',
                    textColor: 'blue'
                },
                {
                    width: '100%',
                    color: 'bg-success',
                    text: 'Very Strong',
                    textColor: 'green'
                }
            ];
            progressBar.style.width = strengths[strength].width;
            progressBar.className = `progress-bar ${strengths[strength].color}`;
            strengthText.textContent = strengths[strength].text;
            strengthText.style.color = strengths[strength].textColor;
        }

        function updatePasswordRequirements(password) {
            const lengthRequirement = document.getElementById('length');
            const lowercaseRequirement = document.getElementById('lowercase');
            const uppercaseRequirement = document.getElementById('uppercase');
            const numberRequirement = document.getElementById('number');
            const specialRequirement = document.getElementById('special');

            if (password.length >= 8) {
                lengthRequirement.classList.add('valid');
                lengthRequirement.classList.remove('invalid');
            } else {
                lengthRequirement.classList.add('invalid');
                lengthRequirement.classList.remove('valid');
            }

            if (/[a-z]/.test(password)) {
                lowercaseRequirement.classList.add('valid');
                lowercaseRequirement.classList.remove('invalid');
            } else {
                lowercaseRequirement.classList.add('invalid');
                lowercaseRequirement.classList.remove('valid');
            }

            if (/[A-Z]/.test(password)) {
                uppercaseRequirement.classList.add('valid');
                uppercaseRequirement.classList.remove('invalid');
            } else {
                uppercaseRequirement.classList.add('invalid');
                uppercaseRequirement.classList.remove('valid');
            }

            if (/\d/.test(password)) {
                numberRequirement.classList.add('valid');
                numberRequirement.classList.remove('invalid');
            } else {
                numberRequirement.classList.add('invalid');
                numberRequirement.classList.remove('valid');
            }

            if (/[\W_]/.test(password)) {
                specialRequirement.classList.add('valid');
                specialRequirement.classList.remove('invalid');
            } else {
                specialRequirement.classList.add('invalid');
                specialRequirement.classList.remove('valid');
            }
        }

        document.getElementById('generate-password').addEventListener('click', function() {
            const password = generatePassword(12);
            document.getElementById('password').value = password;
            document.getElementById('password-confirm').value = password;
            updatePasswordStrength(password);
            updatePasswordRequirements(password);
        });

        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const passwordConfirmField = document.getElementById('password-confirm');
            const icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordConfirmField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                passwordConfirmField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            updatePasswordStrength(password);
            updatePasswordRequirements(password);
        });
    </script>

    <script>
        // Assuming you're using jQuery for AJAX
        $('#email').on('input', function() {
            var email = $(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ route('check.email') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': email
                },
                success: function(response) {
                    if (response.exists) {
                        // Email exists
                        $('#email').addClass('is-invalid');
                        $('#email').siblings('.email-existing').html(
                            '<strong>Email already exists.</strong>');
                    } else {
                        // Email does not exist
                        $('#email').removeClass('is-invalid');
                        $('#email').siblings('.email-existing').html('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#email').addClass('is-invalid');
                    $('#email').siblings('.email-existing').html(
                        '<strong>Error checking email. Please try again later.</strong>');
                }
            });
        });
    </script>
@endsection
