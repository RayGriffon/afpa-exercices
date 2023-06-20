import { useState } from 'react'
import Exercice1 from './Exercice/Exercice1'
import Compteur from './Exercice/Compteur'
import ListeCourse from './Exercice/ListeCourse'
import TMDB from './Exercice/TMDB'
import './App.css'

function App() {

  return (
    <>
      <Exercice1 />
      <Compteur />
      <ListeCourse />
      <TMDB />
    </>
  )
}

export default App
