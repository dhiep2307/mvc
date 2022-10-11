<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="<?=_WEB_ROOT?>/public/assets/css/login/style.css">
    </head>
    <body>
        <div id="main">
            <form id="form-input" action="<?=_WEB_ROOT?>/login/submit" method="POST">
                <div style="width: 100%; font-size: 30px; text-align: center; color: #f15a2b; margin-bottom: 20px;">Đăng nhập</div>
                <div class="user-name">
                    <label for="name">Tên đăng nhập</label>
                    <input id="name" name="user" type="text" placeholder="Tên đăng nhập">
                </div>
                <div class="user-password">
                    <label for="password">Mật khẩu</label>
                    <input id="password" name="pass" type="password" placeholder="Mật khẩu">
                </div>
                <div class="button">
                    <button type="submit" name="sub_login">Đăng nhập</button>
                </div>
            </form>
        </div>

        <script  type="module"  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> 
        <script  nomodule  src = "https: // unkg .com / ionicons @ 5.5.2 / dist / ionicons / ionicons.js "></script>
    </body>
</html>