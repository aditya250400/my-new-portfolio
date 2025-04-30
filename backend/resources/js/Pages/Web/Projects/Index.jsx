import BlogCard from "@/Components/BlogCard";
import ProjectCard from "@/Components/ProjectCard";
import SearchBlog from "@/Components/SearchBlog";
import MasterLayour from "@/Pages/Layout/MasterLayout";
import { Link, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Index(props) {
    const { projects } = props.page_data;

    return (
        <>
            <section
                id="blog"
                className="pt-36  bg-slate-200 dark:bg-slate-800 "
            >
                <div className="w-full px-4">
                    <div className="max-w-xl mx-auto text-center mb-16">
                        <h4 className="font-semibold text-lg text-primary mb-2">
                            Portofolio
                        </h4>
                        <h2 className="font-bold text-dark text-3xl mb-4 dark:text-white">
                            Project Terbaru
                        </h2>
                        <p className="font-medium text-secondary text-md mb-4">
                            Kumpulan project yang telah saya buat
                        </p>
                    </div>
                </div>

                <div className="flex flex-wrap mt-3 w-10/12 mx-auto">
                    {projects.map((project, index) => (
                        <ProjectCard item={project} key={index} />
                    ))}
                </div>
            </section>
        </>
    );
}

Index.layout = (page) => <MasterLayour children={page} />;
