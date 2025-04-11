@extends('layouts.custom_layout') @section('content')
<section class="login-page-wrapper py-3 d-flex align-items-center">
    <div class="container">
        <div class="row">
            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center justify-content-between px-4 py-3 rounded shadow-sm fade show" role="alert" style="background-color: #f8d7da; border-left: 6px solid #dc3545;">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-exclamation me-2 text-danger fs-4"></i>
                    <span class="fw-semibold text-dark">{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="col-lg-6">
                <div class="login-right-col">
                    <h2>“ Track Your Impact , Make Progress, Transform Lives “</h2>
                    <form id="loginForm" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="login-row">
                            <input type="email" name="email" id="email" placeholder="Email Address" required />
                        </div>

                        <div class="login-row">
                            <span class="text-white"><i class="fa-solid fa-eye-slash text-white"></i>Conceal</span>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                        </div>

                        <div class="login-row-remember">
                            <div class="login-form-remember-button">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" />
                                    <p>Remember me</p>
                                </div>
                            </div>

                            <div class="password-assistance-wrap">
                                <a href="#">
                                    Password Assistance
                                </a>
                            </div>
                        </div>

                        <div class="login-form-plicy">
                            <p>We truly protect your personal information registered in the system in accordance to <a href="#">privacy laws</a> laws and <a href="#"> our policy</a></p>
                        </div>

                        <div class="login-row">
                            <input type="submit" value="GO !" />
                        </div>
                    </form>
                    <script>
                        document.getElementById('email').addEventListener('input', function () {
                            this.value = this.value.toLowerCase();
                        });
                        document.addEventListener("DOMContentLoaded", function () {
                            const passwordInput = document.getElementById("password");
                            const toggleSpan = document.querySelector(".login-row span");
                            const toggleIcon = toggleSpan.querySelector("i");

                            toggleSpan.addEventListener("click", function () {
                                if (passwordInput.type === "password") {
                                    passwordInput.type = "text";
                                    toggleIcon.classList.remove("fa-eye-slash");
                                    toggleIcon.classList.add("fa-eye");
                                    toggleSpan.childNodes[1].nodeValue = " Reveal";
                                } else {
                                    passwordInput.type = "password";
                                    toggleIcon.classList.remove("fa-eye");
                                    toggleIcon.classList.add("fa-eye-slash");
                                    toggleSpan.childNodes[1].nodeValue = " Conceal";
                                }
                            });

                            // Remember Me logic
                            const rememberSwitch = document.getElementById("flexSwitchCheckChecked");
                            const emailInput = document.getElementById("email");

                            if (localStorage.getItem("rememberMe") === "true") {
                                emailInput.value = localStorage.getItem("email");
                                rememberSwitch.checked = true;
                            } else {
                                rememberSwitch.checked = false; // default off
                            }

                            document.getElementById("loginForm").addEventListener("submit", function () {
                                if (rememberSwitch.checked) {
                                    localStorage.setItem("rememberMe", "true");
                                    localStorage.setItem("email", emailInput.value);
                                } else {
                                    localStorage.removeItem("rememberMe");
                                    localStorage.removeItem("email");
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
