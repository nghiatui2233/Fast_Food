// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCKSsjwaEpmwce7tVVbIUnilUk7Rz2hEto",
  authDomain: "fast-food-app-9a42b.firebaseapp.com",
  databaseURL: "https://fast-food-app-9a42b-default-rtdb.firebaseio.com",
  projectId: "fast-food-app-9a42b",
  storageBucket: "fast-food-app-9a42b.appspot.com",
  messagingSenderId: "125315474513",
  appId: "1:125315474513:web:67bed0e5450a760490c470",
  measurementId: "G-V2FZ4R1FFG"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);