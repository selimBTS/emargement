document.addEventListener("DOMContentLoaded", () => {
  const calendar = document.getElementById("calendar");
  const monthLabel = document.getElementById("month-label");
  const prevBtn = document.getElementById("prev-month");
  const nextBtn = document.getElementById("next-month");

  let currentDate = new Date();

  function generateCalendar(month, year) {
    const today = new Date();
    const firstDay = new Date(year, month).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const prevMonthDays = new Date(year, month, 0).getDate();

    let date = 1;
    let html = "<thead><tr>";
    const days = ['lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.', 'dim.'];
    html += days.map(day => `<th>${day}</th>`).join('') + "</tr></thead><tbody>";

    let dayIndex = (firstDay + 6) % 7;
    for (let i = 0; i < 6; i++) {
      html += "<tr>";
      for (let j = 0; j < 7; j++) {
        if (i === 0 && j < dayIndex) {
          html += `<td class="inactive"></td>`;
        } else if (date > daysInMonth) {
          html += `<td class="inactive"></td>`;
        } else {
          const isToday = date === today.getDate() && month === today.getMonth() && year === today.getFullYear();
          html += `<td class="${isToday ? 'today' : ''}" data-date="${year}-${month + 1}-${date}">${date}</td>`;
          date++;
        }
      }
      html += "</tr>";
      if (date > daysInMonth) break;
    }
    html += "</tbody>";
    calendar.innerHTML = html;

    document.querySelectorAll("#calendar td").forEach(td => {
      td.addEventListener("click", () => {
        if (!td.classList.contains("inactive") && td.dataset.date) {
          const eventText = prompt("Ajouter un événement pour le " + td.dataset.date + " :");
          if (eventText) {
            const eventDiv = document.createElement("div");
            eventDiv.style.fontSize = "0.75rem";
            eventDiv.style.color = "#0E1E5B";
            eventDiv.textContent = eventText;
            td.appendChild(eventDiv);
          }
        }
      });
    });

    const options = { month: 'long', year: 'numeric' };
    const label = new Date(year, month).toLocaleDateString('fr-FR', options);
    monthLabel.textContent = label.charAt(0).toUpperCase() + label.slice(1);
  }

  prevBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
  });

  nextBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
  });

  generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
});
