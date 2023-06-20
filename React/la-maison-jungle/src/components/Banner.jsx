import '../styles/Banner.css'
import logo from '../assets/logo.png'

const Banner = () => 
    <div className="lmj-banner">
        <h1>La maison jungle</h1>
        <img src={logo} alt='La maison jungle' className='lmj-logo' />
    </div>

export default Banner