function saveRecord(event) {

    const formData = new FormData(event.target);

    // Send the form data to the PHP script using AJAX
    fetch('pet_health_records.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateRecordsTable(data.record);
                event.target.reset(); // Reset the form
            } else {
                alert('Error saving record: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updateRecordsTable(record) {
        const recordsBody = document.getElementById('records-body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${record.photo}" alt="Pet Photo" style="width: 100px; height: auto;"></td>
            <td>${record.petName}</td>
            <td>${record.breedName}</td>
            <td>${record.healthIssue}</td>
            <td>${record.description}</td>
        `;
        recordsBody.appendChild(row);
    }

    function fetchRecords() {
        fetch('petscategory.php')
            .then(response => response.json())
            .then(data => {
                const recordsBody = document.getElementById('records-body');
                recordsBody.innerHTML = ''; 
                data.records.forEach(record => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><img src="${record.photo}" alt="Pet Photo" style="width: 100px; height: auto;"></td>
                        <td>${record.petName}</td>
                        <td>${record.breedName}</td>
                        <td>${record.healthIssue}</td>
                        <td>${record.description}</td>
                    `;
                    recordsBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching records:', error);
            });
    }
