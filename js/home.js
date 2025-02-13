// home.js  

// Toggle the sidebar visibility  
function toggleSidebar() {  
    const sidebar = document.getElementById('sidebar');  
    sidebar.classList.toggle('hidden');  
}  

// Initialize the chart  
document.addEventListener('DOMContentLoaded', function () {  
    const ctx = document.getElementById('chart').getContext('2d');  

    new Chart(ctx, {  
        type: 'line',  
        data: {  
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],  
            datasets: [  
                {  
                    label: 'Weight (kg)',  
                    data: [70, 68, 67, 66, 65, 64],  
                    borderColor: 'rgba(75, 192, 192, 1)',  
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                    tension: 0.4,  
                },  
                {  
                    label: 'Muscle Mass (kg)',  
                    data: [30, 31, 32, 33, 34, 35],  
                    borderColor: 'rgba(153, 102, 255, 1)',  
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',  
                    tension: 0.4,  
                },  
            ],  
        },  
        options: {  
            responsive: true,  
            maintainAspectRatio: false,  
            scales: {  
                y: {  
                    beginAtZero: true,  
                },  
            },  
        },  
    });  
});