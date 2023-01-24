<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
   <title>DataTable</title>
</head>
<body>
   <h1>DataTable</h1>
   <table id="table" class="table">
       <thead>
           <tr>
               <td>番号</td>
               <td>タイトル</td>
               <td>リンク</td>
           </tr>
       </thead>
       <tbody>
           <tr>
               <td>1</td>
               <td>Google</td>
               <td><a href="https://google.com">https://google.com</a></td>
           </tr>
           <tr>
               <td>2</td>
               <td>Yahoo!Japan!</td>
               <td><a href="https://yahoo.co.jp">https://yahoo.co.jp</a></td>
           </tr>
           <tr>
               <td>3</td>
               <td>TECH I.S.</td>
               <td><a href="https://techis.jp">https://techis.jp</a></td>
           </tr>
       </tbody>
   </table>
   <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
   <!-- 下記コードに修正、日本語表記に切り替える -->
   <script>
       $(document).ready(function(){
           $("#table").DataTable({
               "language": {
               "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
               }
           });
       })
   </script>
</body>
</html>