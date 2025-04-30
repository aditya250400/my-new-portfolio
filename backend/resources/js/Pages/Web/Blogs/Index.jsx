import BlogCard from "@/Components/BlogCard";
import SearchBlog from "@/Components/SearchBlog";
import MasterLayour from "@/Pages/Layout/MasterLayout";
import { Link, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Index(props) {
    const { all_blogs, categories } = props.page_data;

    return (
        <>
            <section
                id="blog"
                className="pt-36  bg-slate-200 dark:bg-slate-800"
            >
                <div className="max-w-screen-2xl mx-auto">
                    <div className="">
                        <div className="w-full p-4 flex justify-between items-center ">
                            <h2 className="font-bold text-dark text-xl lg:text-3xl  dark:text-white">
                                Semua Artikel
                            </h2>

                            <Link
                                href={route("front.blogs.all")}
                                className="text-primary font-bold block border-2 border-slate-400 hover:border-primary rounded-xl p-2"
                            >
                                Lihat Semua
                            </Link>
                        </div>
                    </div>

                    <div className="flex flex-wrap mt-3 ">
                        {all_blogs.map((blog, index) => (
                            <BlogCard item={blog} key={index} />
                        ))}
                    </div>
                </div>
            </section>

            {categories.map((category, index) => (
                <section
                    id="blog"
                    key={index}
                    className=" bg-slate-200 dark:bg-slate-800
"
                >
                    <div className="max-w-screen-2xl mx-auto">
                        <div className="">
                            <div className="w-full p-4 flex justify-between items-center">
                                <h2 className="font-bold text-dark text-xl lg:text-3xl  dark:text-white">
                                    Artikel {category.name}
                                </h2>

                                <Link
                                    href={route("front.blogs.category", [
                                        category.slug,
                                    ])}
                                    className="text-primary font-bold block border-2 border-slate-400 hover:border-primary rounded-xl p-2"
                                >
                                    Lihat Semua
                                </Link>
                            </div>
                        </div>

                        <div className="flex flex-wrap mt-3 ">
                            {category.blogs.map((blog, index) => (
                                <BlogCard item={blog} key={index} />
                            ))}
                        </div>
                    </div>
                </section>
            ))}
        </>
    );
}

Index.layout = (page) => <MasterLayour children={page} />;
