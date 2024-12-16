<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <title>Registration Form</title>
    <style>
        .text-danger {
            color: red;
        }
    </style>
</head>

<body>
    <div class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h3>Register</h3>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('post.register') }}" method="post" id="registrationForm">
                            @csrf

                            <div class="col-12">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    aria-describedby="emailHelpId" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger"
                                        id="password_error">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="col-12">
                                <label>
                                </label>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn bsb-btn-xl btn-dark" type="submit">Register</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <p>Already registered? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#registrationForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 30
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 30
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        passwordFormat: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        maxlength: "Maximum 50 characters allowed"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        maxlength: "Email address must not exceed 50 characters"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Minimum 8 characters required"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element);
                }
            });
            $.validator.addMethod("passwordFormat", function(value, element) {
                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
            }, "Password must contain 1 capital letter, 1 small letter, 1 special character, 1 number");
        });
    </script>
</body>
</main>

</html>
