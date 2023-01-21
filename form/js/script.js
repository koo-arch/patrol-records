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

const Length = placeArray.length;

// keyArray配列の重複部分の削除
const optArray = placeArray.filter(function (x, i, self) {
    return self.indexOf(x) === i;
});

// 場所、形式を格納するオブジェクトの定義
const placeInfos = new Array(Length);
for (let i = 0; i < Length; i++) {
    placeInfos[i] = { place: '', type: ''};
}
for (let i = 0; i < Length; i++) {
    placeInfos[i].place = placeArray[i];
    placeInfos[i].type = typeArray[i];
}

// 教室と利用可能PC台数の格納
const PCnums = new Array(Length);
for (let i = 0; i < Length; i++) {
    PCnums[i] = { room: '', pcnum: 0 }
}
for (let i = 0; i < Length; i++) {
    PCnums[i].room = placeArray[i] + typeArray[i];
    PCnums[i].pcnum = pcnumArray[i];
}

const placeSelects = document.getElementById('place');
const PCtypeSelects = document.getElementById('PCtype');
const PCnum = document.getElementById('pcnum');

// id='place'の部分にセレクトボックスの要素を追加
optArray.forEach(place => {
    const option = document.createElement('option');
    option.textContent = place;

    placeSelects.appendChild(option);
});

// 場所が選択された時に形式のプルダウンを生成
placeSelects.addEventListener('input' , () => {

    PCnum.value = '';
    // 形式のプルダウンをリセット
    const options = document.querySelectorAll('#PCtype > option');
    options.forEach(option => {
        option.remove();
    });


    // 形式のプルダウンに「選択」を加える
    const firstSelect = document.createElement('option');
    firstSelect.textContent = '選択';
    PCtypeSelects.appendChild(firstSelect);

    // 形式を選択可能にする
    PCtypeSelects.disabled = false;

    if (placeSelects.value == '場所を選択') {
        PCtypeSelects.disabled = true;
        return;
    }

    // 場所にある形式のみを選択肢に設定
    placeInfos.forEach(placeInfo => {
        if (placeSelects.value == placeInfo.place) {
            const option = document.createElement('option');
            option.textContent = placeInfo.type;
            PCtypeSelects.appendChild(option);
        }
    });
});

// 形式が選択された時に対応するPC台数が入力
PCtypeSelects.addEventListener('input' , () => {

    const roomName = placeSelects.value + PCtypeSelects.value;
    // 利用可能PC台数の初期化
    PCnum.value = '';
    // 選択された場所、形式に対応するPC台数の表示
    PCnums.forEach(num => {
        if (roomName == num.room) {
            PCnum.value = num.pcnum;
        }
    });

    if (roomName === '西2実習室') {
        document.querySelectorAll("div#count_own button").forEach(e => e.disabled = false);
        document.querySelectorAll("div#count_own input").forEach(e => e.disabled = false);
    } else {
        document.querySelectorAll("div#count_own button").forEach(e => e.disabled = true);
        document.querySelectorAll("div#count_own input").forEach(e => e.disabled = true);
    }

});

counter('up1', 'down1', 'univ', 'reset1');
counter('up2', 'down2', 'own', 'reset2');