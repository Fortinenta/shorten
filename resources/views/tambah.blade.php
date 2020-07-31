<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
    sessionStorage.removeItem("alert");
  </script>
    <form class="" action="{{ url('tambah_url') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <h3>URL Asli :</h3>
      <input type="text" name="url" id="url" value="">
      <h3>URL Short :</h3>
      <input type="text" name="short" id="short" value="">
      <input type="submit" name="" value="Tambah">
    </form>
    <a href="{{ url('shorten') }}">
        <button type="button" name="button">Batal</button>
    </a>
  </body>
</html>
