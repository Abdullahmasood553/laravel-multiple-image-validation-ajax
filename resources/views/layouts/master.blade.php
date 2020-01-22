<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyApp | Abnation</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
          .photo-img {
              width: 60px;
              height: 60px;
              background-repeat: no-repeat;
              background-size: cover;
              background-position: center;
              margin-right: 20px;
              border-radius: 50%;
          }


        .photo-row {
            margin-bottom: 30px;
        }

        .profile-content, .photo-row {
            display: flex;
            align-items: center;
        }

      .change-photo {
          cursor: pointer;
          color: #010101;
          font-size: 16px;
          font-weight: 400;
          font-family: 'Open Sans', sans-serif;
      }
        .change-photo {
            font-size: 13px;
        }

      .delete-photo {
        color: #D61043;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Open Sans', sans-serif;
    }

    .delete-photo span {
        color: #AFAFAF;
        margin: 0 10px;
    }

    /* image validation css */

    img {
    max-width: 100%;
    display: block;
}

    .img-uploade-row {
    display: flex;
    margin: -10px;
}

.upload-column {
    width: calc(100% / 5);
    position: relative;
    padding: 10px 10px;
    border: 1px ;
}

.img-uploaders {
    width: 100%;
    height: 120px;
    margin: 0;
    border: 1px dashed #CACACA;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}


.upload-imgs h4 {
    margin-bottom: 20px;
    color: #464855;
    font-weight: 600;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
}

.upload-column p {
    margin: 0;
    text-align: center;
    text-transform: uppercase;
    color: #464855;
    font-weight: 500;
    font-size: 13px;
}



</style>
</head>
<body>

  <div id="notifDiv"
		style="z-index:10000; display: none; background: green; font-weight: 450; width: 350px; position: fixed; top: 80%; left: 5%; color: white; padding: 5px 20px">
  </div>

      @yield('content')
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    @yield('javascript')
</body>
</html>