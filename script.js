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


// 利用可能PC数の連想配列
let pcnumDict = {};
for (let i = 0; i < pcnumArray.length; i++) {
    let pcnum_key = keyArray[i] + valueArray[i];
    pcnumDict[pcnum_key] = pcnumArray[i];
}

// keyArray配列の重複部分の削除
let optArray = keyArray.filter(function (x, i, self) {
    return self.indexOf(x) === i;
});

const select = document.getElementById('place');

// id='place'の部分にセレクトボックスの要素を追加
for (let i = 0; i < optArray.length; i++) {
    let op = document.createElement('option');
    op.value = optArray[i];
    op.textContent = optArray[i];
    select.appendChild(op);
}

let typeArray = { "": ["選択"] };

for (let i = 0; i < keyArray.length; i++) {
    typeArray[keyArray[i]] = ['選択'];
}
for (let i = 0; i < keyArray.length; i++) {
    let array1 = [];
    array1.push(valueArray[i])
    typeArray[keyArray[i]] = typeArray[keyArray[i]].concat(array1);
}



console.log(typeArray);
const placeSelects = document.getElementById('place');
const PCtypeSelects = document.getElementById('PCtype');

placeSelects.addEventListener('input' , () => {
    const options = document.querySelectorAll('#PCtype > option');
    options.forEach(option => {
        option.remove();
    });

    const firstSelect = document.createElement('option');
    firstSelect.textContent = '選択';
    firstSelect.value = '選択';

    

})




// 場所のセレクトボックスを選択した時に動作
document.getElementsByName('place')[0].onchange = function () {
    const place = this.value;
    const elm = document.getElementsByName('PCtype')[0];
    elm.options.length = 0;
    // 選択に応じて形式のセレクトボックスの内容が変化
    for (let i = 0; i < typeArray[place].length; i++) {
        const op = document.createElement('option');
        op.value = place + typeArray[place][i];
        op.textContent = typeArray[place][i];
        elm.appendChild(op);
    }

    const elm2 = document.getElementById('pcnum');
    elm2.value = '';
};

// 形式のセレクトボックスを選択したときに動作
document.getElementsByName('PCtype')[0].onchange = function () {
    const PCtype = this.value;
    const elm = document.getElementsByName('pcnum')[0];
    if (PCtype.includes('選択')) {
        elm.value = '';
    } else {
        elm.value = pcnumDict[PCtype];
    }
    if (this.value === '西2実習室') {
        document.querySelectorAll("div#count_own button").forEach(e => e.disabled = false);
        document.querySelectorAll("div#count_own input").forEach(e => e.disabled = false);
    } else {
        document.getElementById('reset2').click();
        document.querySelectorAll("div#count_own button").forEach(e => e.disabled = true);
        document.querySelectorAll("div#count_own input").forEach(e => e.disabled = true);
    }
};

window.addEventListener('DOMContentLoaded', function () {
    document.getElementsByName('place')[0].onchange();
    document.getElementsByName('PCtype')[0].onchange();
});

counter('up1', 'down1', 'univ', 'reset1');
counter('up2', 'down2', 'own', 'reset2');