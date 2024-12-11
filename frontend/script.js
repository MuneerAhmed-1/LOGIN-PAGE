const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

$('#signup-form').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: '../backend/signup.php',
        data: formData,
        success: function (response) {
            if (response.success) {
                console.log("Success:", response);
                Toastify({
                    text: "Registration successful!",
                    duration: 3000,
                    style: {
                        borderRadius: '10px'
                    }
                }).showToast();
                $('#signup-form')[0].reset()
            } else if (!response.success) {
                console.log("Error:", response.message);
                Toastify({
                    text: response.message,
                    duration: 3000,
                    style: {
                        borderRadius: '10px',
                        background: "red"
                    }
                }).showToast();
            }
        },
        error: function (x, s, e) {
            console.error("AJAX Error:", x, s, e);
            Toastify({
                text: "Something went wrong",
                duration: 3000,
                style: {
                    borderRadius: "10px",
                    background: "red"
                }
            }).showToast();
        }
    });
});

$('#signin-form').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: '../backend/signin.php',
        data: formData,
        success: function (response) {
            if (response.success) {
                console.log("Success:", response);
                Toastify({
                    text: response.message,
                    duration: 3000,
                    style: {
                        borderRadius: '10px'
                    }
                }).showToast();
                $('#signin-form')[0].reset()
            } else if (!response.success) {
                console.log(response.message);
                Toastify({
                    text: response.message,
                    duration: 3000,
                    style: {
                        borderRadius: '10px',
                        background: "red"
                    }
                }).showToast();
            }
        },
        error: function (x, s, e) {
            console.error("AJAX Error:", x, s, e);
            Toastify({
                text: "Something went wrong",
                duration: 3000,
                style: {
                    borderRadius: "10px",
                    background: "red"
                }
            }).showToast();
        }
    });
})

$('#employees').on('input', function () {
    var employees = $('#employees').val().trim();
    var employee_err = $('#employee_err');
    var numberRegex = /^[0-9]+$/;
    if (employees === "") {
        employee_err.text("")
        return true;
    }
    if (!numberRegex.test(employees)) {
        employee_err.text("Age should be numbers only.");
        employee_err.css({
            color: "red",
            fontSize: "14px"
        })
        return false;
    } else {
        employee_err.text("");
        return true;
    }
})

$('#togglePassword').on('click', function () {
    const type = $('#password').attr('type') === 'password' ? 'text' : 'password';
    $('#password').attr('type', type);
    $(this).toggleClass('fa-eye fa-eye-slash');
})

$('#signInTogglePassword').on('click', function () {
    const type = $('#signInPassword').attr('type') === 'password' ? 'text' : 'password';
    $('#signInPassword').attr('type', type);
    $(this).toggleClass('fa-eye fa-eye-slash');
})