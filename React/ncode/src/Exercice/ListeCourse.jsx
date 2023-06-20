import React, { useState } from 'react';

const ShoppingListApp = () => {
    const [items, setItems] = useState([]);
    const [newItem, setNewItem] = useState('');

    const handleInputChange = (event) => {
        setNewItem(event.target.value);
    }

    const handleAddItem = () => {
        if (newItem.trim() !== '') {
            setItems([...items, newItem]);
            setNewItem('');
        }
    }

    return (
        <div>
            <h2>Liste de courses</h2>
            <ul>
                {items.map((item, index) => (
                    <li key={index}>{item}</li>
                ))}
            </ul>
            <div>
                <input type="text" value={newItem} onChange={handleInputChange} placeholder="Ajouter un élément" />
                <button onClick={handleAddItem}>Ajouter</button>
            </div>
        </div>
    );
}

export default ShoppingListApp;
