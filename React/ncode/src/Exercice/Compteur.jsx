import React, { useState } from 'react';

const CounterApp = () => {
    const [counter, setCounter] = useState(0);

    const handleIncrement = () => {
        setCounter(counter + 1);
    }

    return (
        <div>
            <h1>Compteur: {counter}</h1>
            <button onClick={handleIncrement}>Incrémenter</button>
        </div>
    );
}

export default CounterApp;
