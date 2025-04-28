import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";

export default function MasterLayour({ children }) {
    return (
        <>
            <Navbar />
            {children}
            <Footer />
        </>
    );
}
