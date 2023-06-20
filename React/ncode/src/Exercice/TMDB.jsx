import React, { useState } from 'react';

const MovieSearchApp = () => {
    const [searchQuery, setSearchQuery] = useState('');
    const [movies, setMovies] = useState([]);

    const handleInputChange = (event) => {
        setSearchQuery(event.target.value);
    }

    const handleSearch = async () => {
            const url = `http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=${searchQuery}`;
            const response = await fetch(url);
            const data = await response.json();
            setMovies(data.results);
    }

    return (
        <div>
            <h2>Recherche de films</h2>
            <div>
                <input type="text" value={searchQuery} onChange={handleInputChange} placeholder="Nom du film" />
                <button onClick={handleSearch}>Rechercher</button>
            </div>
            {movies.length > 0 ? (
                <ul>
                    {movies.map((movie) => (
                        <li key={movie.id}>{movie.title}</li>
                    ))}
                </ul>
            ) : (
                <p>Aucun résultat.</p>
            )}
        </div>
    );
}

export default MovieSearchApp;
