const resetButton = document.getElementById('reset');
const order = document.getElementById('order');
const year = document.getElementById('year');
const month = document.getElementById('month');
const day = document.getElementById('day');

resetButton.onclick = function () {
    order.selectedIndex = 0;
    year.selectedIndex = 0;
    month.selectedIndex = 0;
    day.selectedIndex = 0;
}