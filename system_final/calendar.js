let currentMonth = 0; // January is the first month (0 index)
const months = document.querySelectorAll('.calendar');

document.getElementById('next').addEventListener('click', function() {
    if (currentMonth < months.length - 1) {
        months[currentMonth].style.display = 'none';
        currentMonth++;
        months[currentMonth].style.display = 'table';
    }
});

document.getElementById('prev').addEventListener('click', function() {
    if (currentMonth > 0) {
        months[currentMonth].style.display = 'none';
        currentMonth--;
        months[currentMonth].style.display = 'table';
    }
});