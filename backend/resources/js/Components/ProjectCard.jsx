import { useState } from "react";

export default function ProjectCard({ item }) {
    const [isClicked, setIsClicked] = useState(false);

    return (
        <div className="mb-12 p-4 md:w-1/2">
            <div className="rounded-md shadow-md overflow-hidden">
                <img src={item.thumbnail} alt={item.title} className="w-full" />
            </div>
            <a
                href={item.website_link ? item.website_link : "#"}
                target="_blank"
                className="block font-semibold text-xl text-dark mt-5 mb-3 hover:text-primary  dark:text-white "
            >
                {item.title}
            </a>
            <p className="font-medium text-base text-secondary whitespace-pre-wrap ">
                {isClicked
                    ? item.description
                    : item.description.substring(0, 150) + "... "}
            </p>
            <button
                onClick={() => setIsClicked(!isClicked)}
                className="text-primary font-bold text-sm"
            >
                {isClicked
                    ? "Tampilkan lebih sedikit..."
                    : "Baca Selengkapnya..."}
            </button>
        </div>
    );
}
