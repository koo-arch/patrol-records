$(document).ready(function () {

    $('#send').click(function () {

        //postメソッドで送るデータを定義 var data = {パラメータ名 : 値};
        var data = {
            timetable: $('#timetable').val(),
            place: $('#place').val(),
            PCtype: $('#PCtype').val(),
            pcnum: $('#pcnum').val(),
            univ: $('#univ').val(),
            own: $('#own').val()
        };

        $.ajax({
            type: "post",
            url: "send.php",
            data: data,
            dataType: 'json',
            //Ajax通信が成功した場合
            success: function (data) {

                //送信完了後フォームの内容をリセット
                if (data[0] == 'true') {
                    $('#overlay, .modal-window').fadeIn();
                    const slicedata = data.slice(1);
                    const resArray = ["res_time", "res_place", "res_room", "res_num", "res_univ", "res_own"]
                    for (let i = 0; i < slicedata.length; i++) {
                        document.getElementById(resArray[i]).textContent = slicedata[i];
                        document.getElementById(resArray[i]).value = slicedata[i];
                        document.getElementsByName(resArray[i])[0].value = slicedata[i];
                    }
                } else {
                    const success = document.getElementsByClassName("success_message")[0];
                    const error = document.getElementsByClassName("error_message")[0];

                    if (success != null) {
                        success.remove();
                    }

                    if (error != null) {
                        error.remove();
                    }

                    const ul = document.createElement('ul');
                    const message = document.getElementById('message');
                    ul.className = "error_message";
                    message.appendChild(ul);
                    data.forEach(element => {
                        const li = document.createElement('li');
                        console.log(element);
                        li.textContent = element;
                        ul.appendChild(li);
                    });

                    $(window).scrollTop(0);
                }

            },
            //Ajax通信が失敗した場合のメッセージ
            error: function () {
                alert('メールの送信が失敗しました。');
            }
        });
        return false;
    });
});

$(function () {
    $('.js-close').click(function () {
        $('#overlay, .modal-window').fadeOut();
    });
});