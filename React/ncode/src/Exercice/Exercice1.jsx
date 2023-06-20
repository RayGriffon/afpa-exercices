import React, { useState, useEffect } from 'react';

const App = (props) => {
    const [nom, setNom] = useState("");
    const [prenom, setPrenom] = useState("");

    useEffect(() => {
        console.log("useEffect 2 ...")
    }, [nom])

    useEffect(() => {
        console.log("useEffect 1 ...")
    }, [])

    const handleClick1 = () => {
        setNom(Math.random().toString(36).replace(/[^a-z]+/g, ''));
        setPrenom(Math.random().toString(36).replace(/[^a-z]+/g, ''));
    }

    console.log("render App...");

    return (
        <>
            <div>
                <input type="text" value={prenom} readOnly />
                <input type="text" value={nom} readOnly />
                {prenom && nom && <div>Bonjour {prenom} {nom}</div>}
            </div>
            <button onClick={handleClick1}>Changer le nom et le prénom</button>
        </>
    );
}

export default App;
