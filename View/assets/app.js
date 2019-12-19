$(document).ready(getUsers);
$(document).on('click', '.connectedUser', getUserMessages);
$(document).on('click', '#send', sendMessage);

//simulate a realtime mechanism ( without sockets )
setInterval(function(){
    getUsers();
    refreshUserMessages();
}, 2000);


/*
    Function used to retrieve all the users
    and inject them in the ul of users
 */
function getUsers()
{
    // console.log("getUsers : working");
    $.ajax({
        type: 'post',
        url: '/njTestChat/user/list',
        dataType: 'json',
        data: "",
        success: function (response) {
            if (response.status === 'ok') {
                $('#users_list').empty();
                $.each(response.result, function(k, v) {
                    let userStatus = (v.online == 1) ? "<small style='color: green'>Online</small>": "<small style='color: red'>offline</small>";
                    let userLiElement = '<li><button class="connectedUser mb-1" style="btn btn-info" value="'+v.username+'">'+ v.username + " - " + userStatus + '</button></li>';
                    $('#users_list').append(userLiElement);
                });
            }
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            // console.log(xhr.responseText);
            // console.log('error users list ' + status);
            console.log("A JS error occurred during ajax call for users list!!")
        }
    });
}


/*
    Function used to retrieve all the messages with a specific user
 */
function getUserMessages()
{
    // console.log('getUserMessages : working');
    var selectedUser = ($(this).prop("value"));
    $.ajax({
        type: 'post',
        url: '/njTestChat/message/list',
        dataType: 'json',
        data: { user_to : selectedUser },
        success: function (response) {
            $('.messageArea').empty();
            $("#send").prop("value", selectedUser);
            if (response.status === 'ok') {
                $.each(response.result, function(k, v) {
                    $('.messageArea').append('<li>'+ v.user_from +' : '+ v.message +'</li>');
                });
            }
        },
        error: function(xhr, status, error) {
            // console.log(status);
            // console.log(xhr.responseText);
            console.log("A JS error occurred during ajax call for user messages!!")
        }
    });
}

/*
    Refresh messages if a user already selected
 */
function refreshUserMessages()
{
    // console.log('refreshUserMessages working');
    var selectedUser = $("button#send").val();
    // console.log("user to refresh => " + selectedUser);
    $.ajax({
        type: 'post',
        url: '/njTestChat/message/list',
        dataType: 'json',
        data: { user_to : selectedUser },
        success: function (response) {
            $('.messageArea').empty();
            $("#send").prop("value", selectedUser);
            if (response.status === 'ok') {
                $.each(response.result, function(k, v) {
                    $('.messageArea').append('<li>'+ v.user_from +' : '+ v.message +'</li>');
                });
            }
        },
        error: function(xhr, status, error) {
            // console.log(status);
            // console.log(xhr.responseText);
            console.log("A JS error occurred during ajax call for refreshUserMessages!!")
        }
    });
}

/*
    Function used to send a message to a specific user
 */
function sendMessage()
{
    $('#errorSending').empty();
    // console.log('sendMessage working');
    event.preventDefault();
    var selectedUser = ($(this).prop("value"));
    var messageTXT = $("#messageTXT").val();
    if(!selectedUser) return;
    $.ajax({
        type: 'post',
        url: '/njTestChat/message/send',
        data: { user_to : selectedUser, message :  messageTXT},
        dataType: 'json',
        success: function (response) {
            $('#messageTXT').val("");
            if (response.status === 'ok') {
                $('.messageArea').append('<li> <span  style="color:green">sent </>: '+ messageTXT +'</li>');
            }else{
                console.log(response);
                $('#errorSending').append('<li> <span  style="color:red">error </> : '+ messageTXT +'</li>');
            }
        },
        error: function(xhr, status, error) {
            // console.log(status);
            // console.log(xhr.responseText);
            console.log("A JS error occurred during ajax call for sendMessage!!")
        }
    });
}


