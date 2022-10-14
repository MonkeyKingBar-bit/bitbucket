$('.login-btn').click(function (e) {
    e.preventDefault();
    $(`input`).removeClass('error-fields');

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'login.class.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
        },
        success (data) {
            if (data.status) {
                document.location.href = '/account.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error-fields');
                    })
                }
                $('.login-error').removeClass('msg-none').text(data.message);

            }
        }
    });
});

$('.register-btn').click(function (e) {
    e.preventDefault();
    $(`input`).removeClass('error-fields');

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val(),
        username = $('input[name="username"]').val(),
        email = $('input[name="email"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();

    let formData = new FormData();
    formData.append('username', username);
    formData.append('login', login);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);

    $.ajax({
        url: 'signup.class.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success (data) {
            if (data.status) {
                document.location.href = '/index.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error-fields');
                    })
                }

                $('.error').removeClass('msg-none').text(data.message);

            }
        }
    });

});