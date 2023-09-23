document.addEventListener("DOMContentLoaded", function() {
    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const container = document.querySelector(".container");
    const calendarBody = document.getElementById("calendarBody");
    const currentMonthYear = document.getElementById("currentMonthYear");
    const previousMonthButton = document.getElementById("previousMonth");
    const todayButton = document.getElementById("today");
    const nextMonthButton = document.getElementById("nextMonth");
    const NUM_SEC_DAY = 86400;

    let currentMonth = new Date().getMonth() + 1;
    let currentYear = new Date().getFullYear();

    function updateCalendar() {
        // Clear previous calendar
        calendarBody.innerHTML = "";

        // Update the current month and year heading
        currentMonthYear.textContent = new Date(currentYear, currentMonth - 1, 1)
            .toLocaleString('en-US', { month: 'long', year: 'numeric' });

        // Determine the first day of the current month
        const firstDayOfMonth = new Date(currentYear, currentMonth - 1, 1).getDay();

        // Calculate the number of days in the current month
        const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();

        let dayCounter = 1;
        let extraCounter = 1;

        // Create the calendar
        for (let i = 0; i < 6; i++) {
            const row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement("td");
                const day = document.createElement("h4");

                if (dayCounter === 1) {
                    if (i === 0 && j === firstDayOfMonth) {
                        day.textContent = dayCounter++;
                    } else {
                        day.textContent = extraCounter++;
                        day.classList.add("extra");
                    }
                } else {
                    if (dayCounter <= daysInMonth) {
                        day.textContent = dayCounter++;
                    } else {
                        day.textContent = extraCounter++;
                        day.classList.add("extra");
                    }
                }

                cell.appendChild(day);
                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
        }
    }

    // Event listeners for navigation buttons
    previousMonthButton.addEventListener("click", () => {
        if (currentMonth === 1) {
            currentMonth = 12;
            currentYear--;
        } else {
            currentMonth--;
        }
        updateCalendar();
    });

    todayButton.addEventListener("click", () => {
        currentMonth = new Date().getMonth() + 1;
        currentYear = new Date().getFullYear();
        updateCalendar();
    });

    nextMonthButton.addEventListener("click", () => {
        if (currentMonth === 12) {
            currentMonth = 1;
            currentYear++;
        } else {
            currentMonth++;
        }
        updateCalendar();
    });

    // Initial calendar update
    updateCalendar();
});
