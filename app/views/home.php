<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thiết Bị</title>
</head>
<style>
    .thiet-bi {
        background-color: rgb(255, 253, 250);
        width: 200px;
        height: 300px;
        margin: 10px;
        border: 2px solid black;
        border-radius: 5px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .thiet-bi img {
        width: 100%;
    }
    
</style>
<body>
    <div>
        <div class="inforuser" style="display:flex">
            <img src="https://dotrinh.com/wp-content/uploads/2019/01/loading_indicator.gif" style="width: 30px" id="img_user" alt="">
            <div id="name_user" style="margin-left:10px; font-size:20px">name</div>
        </div>
        <div id="email">email</div>
        <a href="<?=_WEB_ROOT?>/dang-xuat">Đăng xuất</a>
    </div>
    <div id="thiet-bi-box" style='
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: flex-start;
            align-content: flex-start;
        '>
        <img src="https://dotrinh.com/wp-content/uploads/2019/01/loading_indicator.gif" style="width: 30px" id="img_user" alt="">
    </div>
    <script>

        const HOST = "<?=_WEB_ROOT?>";

        function getApiData(url, func) {
            fetch(HOST + "/" + url)
                .then((response) => response.json())
                .then((data) => {
                    func(data);
                })
                .catch((error) => {
                    func(data = null, error);
                })
        }

        getApiData("info-user", (data, error) => {
            document.getElementById("img_user").src = data.linkimage_US;
            document.getElementById("name_user").innerHTML = data.name_US;
            document.getElementById("email").innerHTML = data.email;
        });

        getApiData("thong-tin-thiet-bi", (data) => {
            const html = data.map((data) => {
                return `
                    <div class="thiet-bi">
                        <img src="${data.linkimg_TB}" alt="">
                        <p>${data.name_TB}</p>
                        <p>${data.disc_TB}</p>
                    </div>
                `;
            }).join('');
            document.getElementById('thiet-bi-box').innerHTML = html;
        });
    </script>
</body>
</html>