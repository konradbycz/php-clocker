const getData = async () => {
  //   Get parent element of containers
  let parent = document.querySelector(".task-loader");
  //   Get children items (task info divs)
  let children = parent.children;
  let taskData = [];

  //   Loop through all children
  for (let index = 0; index < children.length; index++) {
    // TODO fetch specific task data
    const taskId = children[index].id;

    // Getting timer div reference
    let timer = document
      .getElementById(taskId)
      .getElementsByClassName("list-row-task-timer")[0];

    // Placeholder task info
    let taskInfo = null;
    await fetch(`index.php?page=get_session_time&task=${taskId}`).then(response => {
      return response.json()
    }).then(data => {
      console.log(data);
      taskInfo = data;
      taskInfo.totalTime = parseInt(taskInfo.totalTime);
    });

    // If smth goes wrong
    if (taskInfo.msg) {
      timer.innerHTML = "ERROR";
      continue;
    }

    let timeToDisplay =
      taskInfo.startTime !== null
        ? taskInfo.totalTime + (Date.now() / 1000 - taskInfo.startTime)
        : taskInfo.totalTime;

    // Setting initial timer value
    timer.innerHTML = getTimeString(timeToDisplay);

    //   IF startTime !==null setInterval
    if (taskInfo.startTime !== null) {
      startInterval(taskId, timeToDisplay);
    }
  }
};

const startInterval = (taskId, timeToDisplay) => {
  // Getting timer div reference
  let timer = document
    .getElementById(taskId)
    .getElementsByClassName("list-row-task-timer")[0];

  timer.value = timeToDisplay;

  //   Setting timer interval
  setInterval(() => {
    timer.innerHTML = getTimeString(timer.value + 1);
    timer.value += 1;
  }, 1000);
};

const getTimeString = (epoch_time) => {
  // Seconds
  let time = new Date(epoch_time).getTime();
  //   Get amount of hours
  let hours = parseInt(time / 3600);
  //   Substract number of equivalent seconds
  time -= hours * 3600;
  //   Get amount of minutes
  let minutes = parseInt(time / 60);
  //   Substract number of equivalent seconds
  time -= minutes * 60;
  //   Get amount of seconds
  let seconds = parseInt(time);
  //   Adding 0 in front of seconds to have 2 digits

  if (minutes < 10) {
    minutes = `0${minutes}`;
  }
  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  //   Creating response String
  let result = "";
  hours !== 0 ? (result += `${hours}:`) : null;
  minutes !== 0 ? (result += `${minutes}:`) : null;
  result += `${seconds}`;
  return result;
};

const startSession = async (taskId) => {
  await fetch(`index.php?page=start_session&task=${taskId}`);
  window.location.reload();
}

const stopSession = async (taskId) => {
  await fetch(`index.php?page=stop_session&task=${taskId}`);
  window.location.reload();
}
