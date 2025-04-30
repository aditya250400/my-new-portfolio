import MasterLayour from "@/Pages/Layout/MasterLayout";
import { Link } from "@inertiajs/react";

export default function Show(props) {
    const { blog, biodata, other_blogs, other_category_blogs } =
        props.page_data;

    return (
        <>
            <div className="py-20 dark:bg-slate-700 dark:text-white">
                <header className="flex flex-col items-center gap-[50px] mt-[70px]">
                    <div
                        id="Headline"
                        className="max-w-[1130px] mx-auto flex flex-col gap-4 items-center"
                    >
                        <p className="w-fit text-sm lg:text-base text-[#A3A6AE]">
                            {blog.created_at} • {blog.category.name}
                        </p>
                        <h1
                            id="Title"
                            className="font-bold text-xl lg:text-[46px] lg:leading-[60px] text-center "
                        >
                            {blog.title}
                        </h1>
                        <div className="flex items-center justify-center gap-[70px]">
                            <a
                                id="Author"
                                href="author.html"
                                className="w-fit h-fit"
                            >
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 rounded-full overflow-hidden">
                                        <img
                                            src={biodata.photo}
                                            className="object-cover  w-full h-full"
                                            alt="avatar"
                                        />
                                    </div>
                                    <div className="flex flex-col">
                                        <p className="font-semibold text-sm leading-[21px]">
                                            {biodata.name} | {biodata.nim}
                                        </p>
                                        <p className="text-xs leading-[18px] text-[#A3A6AE]">
                                            {biodata.role}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div className="w-full lg:h-[900px] flex shrink-0 overflow-hidden">
                        <img
                            src={blog.thumbnail}
                            className="object-contain lg:object-cover w-full h-full"
                            alt="cover thumbnail"
                        />
                    </div>
                </header>
                <section
                    id="Article-container"
                    className="px-5 lg:px-10 justify-between flex flex-col lg:flex-row gap-5 lg:gap-20 max-w-screen-2xl mx-auto  mt-[25px] lg:mt-[50px]"
                >
                    <div
                        id="Content-wrapper"
                        className="w-full prose-lg prose-h2:font-bold prose-ol:list-disc  whitespace-pre-wrap block"
                        dangerouslySetInnerHTML={{ __html: blog.content }}
                    />

                    <div className="side-bar flex flex-col w-full px-4 lg:px-0 lg:w-[300px] shrink-0 gap-10">
                        {other_category_blogs.blogs.length > 0 ? (
                            <div
                                id="More-from-author"
                                className="flex flex-col gap-4"
                            >
                                <p className="font-bold">
                                    Artikel {other_category_blogs.name} Lainnya
                                </p>
                                <div className="flex flex-row flex-wrap lg:flex-nowrap lg:flex-col gap-2 w-full">
                                    {other_category_blogs.blogs.map(
                                        (blog, index) => (
                                            <Link
                                                href={route(
                                                    "front.blogs.show",
                                                    [blog.slug]
                                                )}
                                                key={index}
                                                className="card-from-author block "
                                            >
                                                <div className="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-primary transition-all duration-300 w-[270px]">
                                                    <div className="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
                                                        <img
                                                            src={blog.thumbnail}
                                                            className="object-cover w-full h-full"
                                                            alt="thumbnail"
                                                        />
                                                    </div>
                                                    <div className="flex flex-col gap-[6px]">
                                                        <p className="line-clamp-2 font-bold">
                                                            {blog.title}
                                                        </p>
                                                        <p className="text-xs leading-[18px] text-[#A3A6AE]">
                                                            {blog.created_at} •{" "}
                                                            {blog.category.name}
                                                        </p>
                                                    </div>
                                                </div>
                                            </Link>
                                        )
                                    )}
                                </div>
                            </div>
                        ) : (
                            ""
                        )}
                        {other_blogs.length > 0 ? (
                            <div
                                id="More-from-author"
                                className="flex flex-col gap-4"
                            >
                                <p className="font-bold">Artikel Lainnya</p>
                                <div className="flex flex-row flex-wrap lg:flex-nowrap lg:flex-col gap-2 w-full">
                                    {other_blogs.map((blog, index) => (
                                        <Link
                                            href={route("front.blogs.show", [
                                                blog.slug,
                                            ])}
                                            key={index}
                                            className="card-from-author block "
                                        >
                                            <div className="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-primary transition-all duration-300 w-[270px]">
                                                <div className="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
                                                    <img
                                                        src={blog.thumbnail}
                                                        className="object-cover w-full h-full"
                                                        alt="thumbnail"
                                                    />
                                                </div>
                                                <div className="flex flex-col gap-[6px]">
                                                    <p className="line-clamp-2 font-bold">
                                                        {blog.title}
                                                    </p>
                                                    <p className="text-xs leading-[18px] text-[#A3A6AE]">
                                                        {blog.created_at} •{" "}
                                                        {blog.category.name}
                                                    </p>
                                                </div>
                                            </div>
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        ) : (
                            ""
                        )}
                    </div>
                </section>
            </div>
            <div className="w-full border-t border-slate-700" />
        </>
    );
}

Show.layout = (page) => <MasterLayour children={page} />;
