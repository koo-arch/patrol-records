const patrolRecords = document.getElementById('patrolRecords');
const columnName = document.getElementById('column-name');
const columnNameList = Object.keys(table[0]);

columnNameList.forEach(name => {
    const th = document.createElement('th');
    th.textContent = name;
    columnName.appendChild(th);
});

table.forEach(row => {
    const tr = document.createElement('tr');
    patrolRecords.appendChild(tr);

    const objArray = Object.entries(row);
    objArray.forEach(arr => {
        const td = document.createElement('td');
        td.textContent = arr[1];
        tr.appendChild(td);
    })
});