import React, { useState } from "react";
import "./App.css";

const API = "http://127.0.0.1:8081/api";

export default function App() {
  const [page, setPage] = useState("login");
  const [token, setToken] = useState("");
  const [form, setForm] = useState({});
  const [data, setData] = useState([]);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const login = async () => {
    const res = await fetch(`${API}/login`, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams(form),
    });
    const d = await res.json();
    if (d.token) {
      setToken(d.token);
      setPage("dashboard");
    } else alert("Login failed");
  };

  const register = async () => {
    try {
      const res = await fetch(`${API}/register`, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(form),
      });
  
      const data = await res.json();
      console.log("REGISTER RESPONSE:", data);
  
      alert("Registered!");
    } catch (err) {
      console.error("REGISTER ERROR:", err);
      alert("Backend not reachable");
    }
  };

  const getUsers = async () => {
    const res = await fetch(`${API}/users`, {
      headers: { Authorization: `Bearer ${token}` },
    });
    const d = await res.json();
    setData(d.data);
  };

  const getTeachers = async () => {
    const res = await fetch(`${API}/teachers`, {
      headers: { Authorization: `Bearer ${token}` },
    });
    const d = await res.json();
    setData(d.data);
  };

  const createTeacher = async () => {
    try {
      const res = await fetch(`${API}/teacher`, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          Authorization: `Bearer ${token}`, // 👈 VERY IMPORTANT
        },
        body: new URLSearchParams(form),
      });
  
      const data = await res.json();
      console.log("CREATE TEACHER RESPONSE:", data);
  
      alert("Teacher Created!");
    } catch (err) {
      console.error("CREATE TEACHER ERROR:", err);
      alert("Request failed");
    }
  };

  return (
    <div className="container">
      <h1>Teacher Management</h1>

      <div className="nav">
        <button onClick={() => setPage("login")}>Login</button>
        <button onClick={() => setPage("register")}>Register</button>
        <button onClick={() => setPage("dashboard")}>Dashboard</button>
      </div>

      {page === "login" && (
        <div className="card">
          <h2>Login</h2>
          <input name="email" placeholder="Email" onChange={handleChange}/>
          <input name="password" placeholder="Password" onChange={handleChange}/>
          <button onClick={login}>Login</button>
        </div>
      )}

      {page === "register" && (
        <div className="card">
          <h2>Register</h2>
          <input name="email" placeholder="Email" onChange={handleChange}/>
          <input name="first_name" placeholder="First Name" onChange={handleChange}/>
          <input name="last_name" placeholder="Last Name" onChange={handleChange}/>
          <input name="password" placeholder="Password" onChange={handleChange}/>
          <button onClick={register}>Register</button>
        </div>
      )}

      {page === "dashboard" && (
        <div className="card">
          <h2>Dashboard</h2>

          <button onClick={getUsers}>Get Users</button>
          <button onClick={getTeachers}>Get Teachers</button>

          <h3>Create Teacher</h3>
          <input name="email" placeholder="Email" onChange={handleChange}/>
          <input name="first_name" placeholder="First Name" onChange={handleChange}/>
          <input name="last_name" placeholder="Last Name" onChange={handleChange}/>
          <input name="password" placeholder="Password" onChange={handleChange}/>
          <input name="university_name" placeholder="University" onChange={handleChange}/>
          <input name="gender" placeholder="Gender" onChange={handleChange}/>
          <input name="year_joined" placeholder="Year" onChange={handleChange}/>
          <input name="subject" placeholder="Subject" onChange={handleChange}/>
          <input name="phone" placeholder="Phone" onChange={handleChange}/>

          <button onClick={createTeacher}>Create Teacher</button>

          <pre>{JSON.stringify(data, null, 2)}</pre>
        </div>
      )}
    </div>
  );
}
