"use client";

import { useState, useEffect } from 'react';
import '@fortawesome/fontawesome-free/css/all.css';


export default function Home() {

  const [formData, setFormData] = useState({
    name: '',
    email: ''
  });

  useEffect(() => {
    // Load saved data from localStorage when the component mounts
    const savedData = localStorage.getItem('formData');
    if (savedData) {
      setFormData(JSON.parse(savedData));
    }
  }, []);


  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    // Save form data to localStorage
    localStorage.setItem('formData', JSON.stringify(formData));
    console.log('Form submitted and saved:', formData);
  };

  const [items, setItems] = useState([
    { id: 1, name: 'Apple' },
    { id: 2, name: 'Banana' },
    { id: 3, name: 'Cherry' },
  ]);

  const [searchTerm, setSearchTerm] = useState('');

 const handleDelete = (id) => {
    setItems(items.filter((item) => item.id !== id));
  };

  const handleSearch = (e) => {
    setSearchTerm(e.target.value);
  };

  const filteredItems = items.filter((item) =>
    item.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

  return (
    <div align="center">
      <h1>Entry Form</h1>
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="name">Name:</label>
          <input
            type="text"
            id="name"
            name="name"
            value={formData.name}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label htmlFor="email">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </div>
		<br/>
        <button type="submit" className="submit-button">
          <i className="fas fa-paper-plane"></i> Submit
        </button>
      </form>

	  <br/><br/><br/>
      <div>
      	<h1>Bucket list</h1>
		<input
        	type="text"
        	placeholder="Search items..."
        	value={searchTerm}
        	onChange={handleSearch}
        	style={{ marginBottom: '20px', padding: '10px', fontSize: '16px', width: '20%' }}
      	/>
      	<ul>
        	{filteredItems.map((item) => (
          	<li key={item.id}>
          		{item.name}&nbsp;
          		<button onClick={() => handleDelete(item.id)} style={{ marginLeft: '10px' }}><i className="fas fa-trash"></i> Delete</button>
          	</li>
        	))}
      	</ul>
      </div>

    </div>

  );

}
