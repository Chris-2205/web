let currentLevel = null;

function submitSolution() {
  const solution = document.getElementById("solution").value.trim();

  fetch("php/submit.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, room, position, solution })
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById("status").textContent = data.message;
    if (data.success) {
      alert("🎉 " + data.message);
      document.getElementById("solution").value = "";
      loadChallenge();
    } else {
      alert("❌ " + data.message);
      document.getElementById("solution").value = "";
    }
  });
}

function loadChallenge() {
  fetch(`php/sync.php?username=${username}&room=${room}`)
    .then(res => res.json())
    .then(data => {
      if (currentLevel !== data.level) {
        currentLevel = data.level;
        document.getElementById("challenge").textContent = `Nivel ${data.level}: ${data.challenge}`;
        document.getElementById("solution").value = "";
        document.getElementById("status").textContent = "";
      }
    });
}

setInterval(loadChallenge, 3000);
loadChallenge();
