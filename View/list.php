<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow mb-4">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">NJ Chat</a>
    <form class="m-2" name="form1" method="post" action="/njTestChat/login/deauth">
        <label>
            <input name="submit2" type="submit" id="submit2" value="log out <?= $_SESSION['username'];?>">
        </label>
    </form>
</nav>

<div class="container-fluid card">
    <div class="row">
        <nav class="col-md-3 d-none d-md-block bg-light sidebar">
            <h1 class="mb-3 border-bottom">Users</h1>
            <ul id="users_list">
                No users detected
            </ul>
        </nav>
        <main role="main" class="col-md-8 px-4">
            <h1 class="mb-3 border-bottom">Messages</h1>
            <ul class="messageArea" >
                <p>Click a user to start chatting and show archived messages!<p>
            </ul>
            <p id="errorSending"></p>
            <div class="form-inline md-12">
                <input name="messageTXT" id="messageTXT" type="text" class="form-control mr-2" placeholder="select user and write your message"/>
                <button id="send" class="btn btn-info" type="button">
                    Send
                </button>
            </div>
            <small style="color:gray"><i class="fas fa-arrow-left"></i>Click on the user to refresh the messages</small>
    </div>
    </main>



</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/njTestChat/View/assets/app.js"></script>
</body>
</html>