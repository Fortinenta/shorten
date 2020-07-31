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

        <form method="post" action="{{ url('search') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" id="key" name="key" placeholder="Masukkan Kata">
            <select name="option" id="option" class="option">
                <option value="short">Berdasarkan</option>
                <option value="short">Short</option>
                <option value="url_asli">URL</option>
            </select>
            <input  type="submit" value="Cari"/>
        </form>

        <select name="format" onchange="location = this.value; ">
            <option value="{{ url('paging', 10) }}">#</option>
            <option value="{{ url('paging', 10) }}">10</option>
            <option value="{{ url('paging', 25) }}">25</option>
            <option value="{{ url('paging', 1000) }}">All</option>
        </select>

        <table class="tabel" >
            <?php foreach ($posts as $post): ?>
            <tr>
                <td>
                    <p id="judul">URL :{{ $post->url_asli }}</p>
                    <p id="judul">URL Short : http://localhost/rabraw/short/{{ $post->short }}</p>
                </td>
                <td>
                    <a href="{{ url('delete_link', $post->short) }}">
                        <button type="button" name="button">Delete</button>
                    </a>
                </td>
                <td>
                    <a href="{{ $post->url_asli }}">
                        <button type="button" name="button">Visit</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php foreach ($page as $halaman): ?>
          <?php for ($i=1; $i <= $halaman->num; $i++) { ?>
              <a href="{{ url('show', $i) }}">
                  {{$i}}
              </a>
              <?php } ?>
        <?php endforeach; ?>
            <a href="{{ url('tambah') }}">
                <button type="button" name="button">Tambah</button>
            </a>
    </body>
</html>
