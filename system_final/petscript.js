function fetchRecords() {
    fetch('fetch_records.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('output').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching records:', error);
        });
}
