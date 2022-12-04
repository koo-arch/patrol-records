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


// keyArray配列の重複部分の削除
const optArray = placeArray.filter(function (x, i, self) {
    return self.indexOf(x) === i;
});

const subCategories = new Array();
for (let i = 0; placeArray.length; i++) {
    subCategories[i] = { place: '', type: '', pcnum: ''};
}
for (let i = 0; placeArray.length; i++) {
    subCategories[i].place = placeArray[i];
    subCategories[i].type = typeArray[i];
    subCategories[i].type = pcnumArray[i];
}

console.log(subCategories);


// 利用可能PC数の連想配列
let pcnumDict = {};
for (let i = 0; i < pcnumArray.length; i++) {
    let pcnum_key = placeArray[i] + typeArray[i];
    pcnumDict[pcnum_key] = pcnumArray[i];
}


const select = document.getElementById('place');

// id='place'の部分にセレクトボックスの要素を追加
for (let i = 0; i < optArray.length; i++) {
    let op = document.createElement('option');
    op.value = optArray[i];
    op.textContent = optArray[i];
    select.appendChild(op);
}


const placeSelects = document.getElementById('place');
const PCtypeSelects = document.getElementById('PCtype');
const PCnum = document.getElementById('pcnum');

placeSelects.addEventListener('input' , () => {

    // 形式のプルダウンをリセット
    const options = document.querySelectorAll('#PCtype > option');
    options.forEach(option => {
        option.remove();
    });


    // 形式のプルダウンに「選択」を加える
    const firstSelect = document.createElement('option');
    firstSelect.textContent = '選択';

    // 形式を選択可能にする
    PCtypeSelects.disabled = false;

    if (placeSelects.value == '選択') {
        PCtypeSelects.disabled = true;
        return;
    }

    // 場所にある形式のみを選択肢に設定
    subCategories.forEach(subCategory => {
        if (placeSelects.value == subCategory.place) {
            const option = document.createElement('option');
            option.textContent = subCategory.type;
            PCnum.value = subCategory.pcnum;
        }
    });
});

counter('up1', 'down1', 'univ', 'reset1');
counter('up2', 'down2', 'own', 'reset2');