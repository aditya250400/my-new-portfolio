import BlogCard from "@/Components/BlogCard";
import SearchBlog from "@/Components/SearchBlog";
import MasterLayour from "@/Pages/Layout/MasterLayout";
import { Link } from "@inertiajs/react";

export default function Category(props) {
    const { category } = props.page_data;

    return (
        <>
            <section
                id="blog"
                className="pt-36  bg-slate-200 dark:bg-slate-800"
            >
                <div className="max-w-screen-2xl mx-auto">
                    <div className="">
                        <div className="w-full p-4 flex justify-center ">
                            <h2 className="font-bold text-dark text-xl lg:text-3xl  dark:text-white">
                                Semua Artikel {category.name}
                            </h2>
                        </div>
                    </div>

                    <div className="flex flex-wrap mt-3">
                        {category.blogs.map((blog, index) => (
                            <BlogCard item={blog} key={index} />
                        ))}
                    </div>
                </div>
            </section>
        </>
    );
}

Category.layout = (page) => <MasterLayour children={page} />;
