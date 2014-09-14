// Userlist data array for filling in info box
var userListData = [];

// DOM Ready =============================================================
$(document).ready(function() {

    // Populate the user table on initial page load
    populateTable();

    // Add User and Run Test button click
    $('#btnAddUser').on('click', addUser);
    $('#btnRunTest').on('click', runTest);

});

// Functions =============================================================

// Fill table with data
function populateTable() {

    // Empty content string
    var tableContent = '';

    // jQuery AJAX call for JSON
    $.getJSON('assets/php/get_users.php', function( data ) {

        // Stick our user data array into a userlist variable in the global object
        userListData = data;

        // For each item in our JSON, add a table row and cells to the content string
        $.each(data, function(){
            tableContent += '<tr>';
            tableContent += '<td>' + this.username + '</td>';
            tableContent += '<td>' + this.email + '</td>';
            tableContent += '<td>' + this.password + '</td>';
            tableContent += '<td>' + this.createdAt + '</td>';
            tableContent += '<td>' + this.modifiedAt + '</td>';
            tableContent += '</tr>';
        });

        // Inject the whole content string into our existing HTML table
        $('table tbody').html(tableContent);
    });
};

// Run Test
function runTest(){

    // test function creates 100 new users
    var i = 0;

    while(i < 100){
        // call add user
        addUser(event);
        // increase value of i
        i++;

    };

    // refresh table view
    populateTable();

    //  notify test complete via console
    console.log('test complete');

}

// Add User
function addUser(event){

    event.preventDefault();

    // Super basic validation - increase errorCount variable if any fields are blank
    var errorCount = 0;
    $('#addUser input').each(function(index, val) {
        if($(this).val() === '') { errorCount++; }
    });

    // Check and make sure errorCount's still at zero
    if(errorCount === 0) {

        // If it is, compile all user info into one object
        var newUser = {
            'username': $('#addUser input#inputUserName').val(),
            'email': $('#addUser input#inputUserEmail').val(),
            'password': $('#addUser input#inputUserPassword').val(),
        }

        // Use AJAX to post the object to our adduser service
        $.ajax({
            type: 'POST',
            data: newUser,
            url: 'assets/php/create_user.php',
            dataType: 'JSON'
        }).done(function( response ) {
            // Check for successful (blank) response
            if (response.msg === '') {

                // Clear the form inputs
                // $('#addUser input#inputUserName').val('');
                // $('#addUser input#inputUserEmail').val('');
                // $('#addUser input#inputUserPassword').val('');

                // Update the table
                // populateTable();

            }
            else {
                // If something goes wrong, alert the error message that our service returned
                alert('Error: ' + response.msg);
            }
        });
    }
    else {
        // If errorCount is more than 0, error out
        alert('Please fill in all fields');
        return false;
    }
};