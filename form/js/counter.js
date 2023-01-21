// カウンターの関数
function counter(up, down, text, reset) {
    const upbutton = document.getElementById(up);
    const downbutton = document.getElementById(down);
    const textbox = document.getElementById(text);
    const resetbutton = document.getElementById(reset);

    // +ボタンクリックで1増える
    upbutton.addEventListener('click', (event) => {
        if (isNaN(textbox.value) == true) {
            textbox.value = 0
        }
        textbox.value = Math.floor(textbox.value)
        textbox.value++;
    });

    // 値が0以上、-ボタンクリックで1減る
    downbutton.addEventListener('click', (event) => {
        if (isNaN(textbox.value) == true) {
            textbox.value = 0;
        }
        textbox.value = Math.floor(textbox.value)
        if (textbox.value > 0) {
            textbox.value--;
        }
    });


    resetbutton.addEventListener('click', (event) => {
        textbox.value = 0;
    });
}

counter('up1', 'down1', 'univ', 'reset1');
counter('up2', 'down2', 'own', 'reset2');