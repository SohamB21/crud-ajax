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
            success: function ($response) {
                console.log($response);
            },
            error: function () {
                console.error('An error occurred:', error);
            }
        })

    })
});