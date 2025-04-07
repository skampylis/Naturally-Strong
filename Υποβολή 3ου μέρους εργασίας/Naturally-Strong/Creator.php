<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Creator Profile-Naturally Strong</title>
        <link rel="icon" href="images\page_images\Logo.jpg">
        <link rel="stylesheet" href="styles\Creator.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="header-wrapper">
                <div id="header-left">
                    <div id="logo">
                        <img src="images\page_images\Logo.jpg" alt="Logo" >
                        <span>Naturally Strong </span>
                    </div>
                    <div id="creator-info">
                        <img src="https://via.placeholder.com/70" alt="Creator's personal image">
                        <p>Creator's Username</p>
                    </div>
                </div>
                <!-- end header-left -->
                <div id="header-center">
                    <img src="https://via.placeholder.com/300x150" alt="Placeholder">
                </div>
                <div id="header-right">
                    <div id="options-top">
                        <button id="logout-button" type="button" onclick="location.href = 'QuickLogout.php' " >Log Out</button>
                    </div>
                    <div id="options-bottom">
                        <button id="messages-button" type="button">Incoming Messages</button>
                        <button id="settings-button" type="button">Settings</button>
                    </div>
                </div>
                <!-- end header-right -->
            </div>
            <!-- end header-wrapper -->
            <form class="boxx" action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            <div id="content">
                <div id="statistics">
                    <ul>
                        <li>
                            <p>Lorem ipsum dolor sit amet</p>
                        <li>
                            <p>Lorem ipsum dolor sit amet</p>
                        <li>
                            <p>Lorem ipsum dolor sit amet</p>
                        <li>
                            <p>Lorem ipsum dolor sit amet</p>
                        <li>
                            <p>Lorem ipsum dolor sit amet</p>
                    </ul>
                </div>
                <div id="creator-options">
                    <button id="upload-button" type="button">Upload</button>
                    <button id="edit-button" type="button">Edit</button>
                    <button id="delete-button" type="button">Delete</button>
                </div>
            </div>
            <!-- end content -->
        </div>
        <!-- end wrapper -->
    </body>
</html>