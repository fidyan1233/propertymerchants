const targets = [500, 710, 840, 450 ]; // target values for the counters
const durations = [100000, 100000, 100000, 100000]; // total durations in milliseconds
let counts = [0, 0, 0, 0, 0, 0, 0, 0];
const counterElements = document.querySelectorAll('.counter');

const updateCounter = (index) => {
  const increment = targets[index] / (durations[index] / 1000); // increment per millisecond
  if (counts[index] < targets[index]) {
    counts[index] += increment;
    counterElements[index].innerHTML = Math.floor(counts[index]);
    setTimeout(() => updateCounter(index), 1); // setting a small interval for smooth increment
  } else {
    counterElements[index].innerHTML = targets[index]; // make sure to display the target value precisely
  }
};

for (let i = 0; i < counterElements.length; i++) {
  updateCounter(i);
}