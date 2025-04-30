import { Link } from "@inertiajs/react";
import { useState } from "react";

export default function BlogCard({ item }) {
    return (
        <div className="w-full px-4 lg:w-1/2 xl:w-1/3 ">
            <div className="bg-white rounded-xl shadow-lg overflow-hidden mb-10 dark:bg-slate-900 relative">
                <img src={item.thumbnail} alt={item.title} className="w-full" />
                <Link
                    href={route("front.blogs.category", [item.category.slug])}
                    className="top-5 left-5 bg-primary rounded-lg absolute p-1 font-bold text-white"
                >
                    {item.category.name}
                </Link>
                <div className="py-8 px-6">
                    <Link
                        href={route("front.blogs.show", [item.slug])}
                        className="block mb-3 font-semibold text-xl text-dark hover:text-primary truncate dark:text-white"
                    >
                        {item.title}
                    </Link>
                    <p className="whitespace-pre-wrap line-clamp-2 hover:line-clamp-none hover:cursor-pointer  font-medium text-base text-secondary mb-6">
                        {item.description}
                    </p>

                    <Link
                        href={route("front.blogs.show", [item.slug])}
                        className="font-medium text-sm text-white bg-primary py-2 px-4 rounded-lg hover:opacity-80"
                    >
                        Baca Selengkapnya
                    </Link>
                </div>
            </div>
        </div>
    );
}
