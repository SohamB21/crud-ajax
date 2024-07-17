// alert('this is home');

$(document).ready(function () {
    $('.submit').click(function (event) {
        event.preventDefault();

        var name = $('.name').val();
        var email = $('.email').val();
        var password = $('.password').val();

        if (name === "" || email === "" || password === "") {
            $('.feedback').text('All the fields are required!');
        } else {
            $.ajax({
                type: 'POST',
                url: ajaxUrl + 'crud/addUser',
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                success: function (data) {
                    var myvar = "";
                    console.log("Response from server:", data);
                    var parsedData = JSON.parse(data);

                    // Get the current date in dd-mm-yyyy format
                    var currentDate = new Date();
                    var day = String(currentDate.getDate()).padStart(2, '0');
                    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
                    var year = currentDate.getFullYear();
                    var formattedDate = day + '-' + month + '-' + year;

                    myvar += '<tr>';
                    myvar += '<td>' + parsedData[0].stId + '</td>';
                    myvar += '<td>' + parsedData[0].stName + '</td>';
                    myvar += '<td>' + parsedData[0].stEmail + '</td>';
                    myvar += '<td>' + parsedData[0].stPassword + '</td>';
                    myvar += '<td>' + formattedDate + '</td>';
                    myvar += '</tr>';

                    $('.table').append(myvar);
                    // $('.table').prepend(myvar);
                    // console.log("myvar - ", myvar);
                    $('.feedback').text('User added successfully!');
                },
                error: function (xhr, status, error) {
                    console.error('An error occurred:', error);
                    $('.error-log').text('Error occurred: ' + error);
                }
            });
        }
    });
    $('.edit').click(function (event) {
        var text = $(this).data('text');
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: ajaxUrl + 'crud/checkUser',
            data: {
                text: text,
                id: id
            },
            success: function (data) {
                var editData = JSON.parse(data);
                // console.log(editData[0].stName);

                var dyField = "";
                dyField += '<div class="mb-3">';
                dyField += '<label for="dyName" class="form-label">Name</label>';
                dyField += '<input type="text" class="dyName form-control" id="dyName" value="'
                    + editData[0].stName + '">';
                dyField += '</div>';

                dyField += '<div class="mb-3">';
                dyField += '<label for="dyEmail" class="form-label">Email</label>';
                dyField += '<input type="email" class="dyEmail form-control" id="dyEmail" value="'
                    + editData[0].stEmail + '">';
                dyField += '</div>';

                dyField += '<div class="mb-3">';
                dyField += '<label for="dyPassword" class="form-label">Password</label>';
                dyField += '<input type="text" class="dyPassword form-control" id="dyPassword" value="'
                    + editData[0].stPassword + '">';
                dyField += '</div>';

                dyField += '<button data-id="' + editData[0].stId + '" class="btn btn-primary dyUpdate">Update</button>';

                $('.dynamicContent .content-container').html(dyField);
                $('.dynamicContent').show();
            },
            error: function () {
                console.error('An error occurred:', error);
            }
        })

    });
    $('body').on('click', '.dyUpdate', function () {
        var dyName = $('.dyName').val();
        var dyEmail = $('.dyEmail').val();
        var dyPassword = $('.dyPassword').val();
        var dyId = $(this).data('id');

        console.log("updated", dyName, dyEmail, dyPassword, dyId);
        if (dyName == "" || dyEmail == "" || dyPassword == "" || dyId == "") {
            $('.dyFeedback').text('All the fields are required!');
        }
        else {
            $.ajax({
                type: 'POST',
                url: ajaxUrl + 'crud/updateUser',
                data: {
                    dyName: dyName,
                    dyEmail: dyEmail,
                    dyPassword: dyPassword,
                    dyId: dyId
                },
                success: function (data) {
                    console.log("Updated successfully!");
                },
                error: function () {
                    console.log("Failed to update!");
                }
            })
        }
    });
    $(document).on('click', '.btn-close, .dyUpdate', function () {
        $('.dynamicContent').hide();
    });
});