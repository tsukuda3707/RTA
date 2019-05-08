<?php include 'header.php'; ?>


<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h1 class="page-header">Playground</h1>

            <div style="display=block;">
                <ul class="list-group list-inline">
                    <li class="col-lg-4">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start query">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#postal_codeから住所を取得する例</h5>
                            </div>
                            <p class="mb-1">
SELECT u.id, u.name, u.postal_code, p.prefecture_name, p.city_name, p.address<br>
FROM users u, #postal_code p<br>
WHERE u.postal_code = p.code;
                            </p>
                        </a>
                    </li>
                    <li class="col-lg-4">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start query">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">現在借りている本のデータを取得する例</h5>
                            </div>
                            <p class="mb-1">
SELECT DISTINCT(b.title), b.author, ur.borrow, ur.return<br>
FROM user_rental ur, #bib_book_internet b<br>
WHERE ur.isbn = b.isbn AND ur.user_id = 1;
                            </p>
                        </a>
                    </li>
                    </li>
                    <li class="col-lg-4">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start query">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#stocksから住所を取得する例</h5>
                            </div>
                            <p class="mb-1">
SELECT u.id, u.name, SUM (us.number * s.ending_price)<br>
FROM users u, user_stocks us, #stocks s<br>
WHERE u.id = us.user_id AND us.code = s.code GROUP BY u.id, u.name;
                            </p>
                        </a>
                    </li>
                </ul>
            </div>

            <form method="POST" action="./result.php" target="_blank">
            <div class="form-group">
                <label for="rtaQuery">RTA Query</label>
                <textarea class="form-control" id="queryForm" rows="5" name="query"></textarea>
            </div>
            <div class="form-group">
                <input id="send" type="submit" value="Execute" class="btn btn-primary col-lg-4 col-lg-offset-4">
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(".query").click(function() {
        $("#queryForm").val($(this).children("p").text());
    });

    $("#send2").click(function() {
      // POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
      var data = {'query' : $('#queryForm').val()};

      /**
       * Ajax通信メソッド
       * @param type  : HTTP通信の種類
       * @param url   : リクエスト送信先のURL
       * @param data  : サーバに送信する値
       */
      $.ajax({
        type: "POST",
        url: "execute_rta.php",
        data: data,
      }).done(function(data, dataType) {
        // successのブロック内は、Ajax通信が成功した場合に呼び出される

        // PHPから返ってきたデータの表示
        console.log('data:' + data);

        // $resultQueryで問い合わせてDataTableにマップする
        $("#result-table").DataTable({
            scrollX: true,
            ajax: 'result.php?query=' + 'select * from result_171215001828',
            columns: [
                { "data": "id" },
                { "data": "name" },
                { "data": "postal_code" },
                { "data": "prefecture_name" },
                { "data": "city_name" },
                { "data": "address" },
                ]
        });

      }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        // 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

        // this;
        // thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

        // エラーメッセージの表示
        alert('Error : ' + errorThrown);
      });

      // サブミット後、ページをリロードしないようにする
      return false;
    });
});

</script>

<?php include 'footer.php'; ?>