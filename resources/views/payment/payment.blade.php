<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: black;
    }

    div {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        color: whitesmoke;
    }

    div span {
        font-size: 4em;
        letter-spacing: 5px;
        text-transform: uppercase;
        line-height: 1;
        mix-blend-mode: difference;
    }

    div::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 150px;
        height: 100%;
        background-color: white;
        transform: skewX(20deg);
        animation: move 4s linear infinite;
    }

    @keyframes move {
        0%,
        100% {
            left: 0;
        }

        50% {
            left: calc(100% - 150px);
        }
    }

</style>
<body>
    <div>
        <span>Payment</span>
    </div>
</body>
</html>
